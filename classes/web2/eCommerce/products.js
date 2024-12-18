window.onload = function() {

    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const selectedProduct = getQueryParam('product');
    console.log(selectedProduct);

    if (selectedProduct) {
        const productTypeSelect = document.getElementById('product-type');
        productTypeSelect.value = selectedProduct;
        console.log(selectedProduct);
        updateSubcategories();
        fetchProducts();
    }
};


function updateSubcategories() {
    const productType = document.getElementById("product-type").value;
    const subcategorySelect = document.getElementById("subcategory");

    // Clear previous options
    subcategorySelect.innerHTML = '<option value="">View All</option>';
    subcategorySelect.disabled = true;

    let subcategories = [];

    switch (productType) {
        case "rods":
            subcategories = ["Saltwater Rod", "Freshwater Rod", "Spinning Rod"];
            break;
        case "reels":
            subcategories = ["Baitcasting Reel", "Spinning Reel", "Fly Reel"];
            break;
        case "lures":
            subcategories = ["Jigs", "Crankbaits", "Spinnerbaits", "Topwater Lures"];
            break;
        default:
            break;
    }

    // Populate subcategory dropdown
    subcategories.forEach(function(subcategory) {
        const option = document.createElement("option");
        option.value = subcategory.toLowerCase().replace(/\s+/g, '-'); // Generate value by formatting the name
        option.textContent = subcategory;
        subcategorySelect.appendChild(option);
    });

    // Enable subcategory dropdown if there are options
    if (subcategories.length > 0) {
        subcategorySelect.disabled = false;
    }
}

function fetchProducts() {
    console.log("in");
    let category = document.getElementById('product-type').value;
    let subcategory = document.getElementById('subcategory').value ?? '';

    fetch('fetch_products.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `category=${category}&subcategory=${subcategory}`,
    })
    .then(response => response.json())
    .then(products => {
        const productGrid = document.getElementById('product-grid');
        productGrid.innerHTML = ''; 

        
        products.forEach(product => {
            let priceTag;
            if (product.id == 16) {
                const discountedPrice = (product.price * 0.8).toFixed(2); // Apply 20% discount
                priceTag = `
                    <span style="text-decoration: line-through;">${product.price}</span>
                    <span style=" font-weight: bold;"> $${discountedPrice}</span>
                `;
            } else {
                priceTag = `<span>${product.price}</span>`;
            }

            const productCard = `
                <article class="list--item">
                    <figure>
                        <img src="${product.image_url}" alt="${product.description}" style="max-width: 200px; max-height: 200px; width: auto; height: auto;" />
                        <header>
                            <div class="floater"></div>
                            <h2>${product.description}</h2>
                        </header>  
                        <figcaption>
                            ${priceTag} 
                        </figcaption>
                            <button onclick="addToCart(${product.id}, '${product.description}', ${product.price}, '${product.image_url}')">Add to Cart</button>

                    </figure>
                </article>
            `;
            productGrid.innerHTML += productCard;
        });
    })
    .catch(error => console.error('Error fetching products:', error));
}

function addToCart(productId, productDescription, productPrice, productImage) {
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${productId}&description=${productDescription}&price=${productPrice}&image_url=${productImage}`,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart!');
            // Optionally, update the cart summary on the page
        } else {
            alert('Failed to add product to cart.');
        }
    })
    .catch(error => console.error('Error adding product to cart:', error));
}



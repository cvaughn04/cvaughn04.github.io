// Function to draw the rectangle on the canvas
function drawRectangle() {
    const canvas = document.getElementById("scratchCanvas");
    const ctx = canvas.getContext("2d");
    
    const underlyingImage = new Image();
    underlyingImage.src = "10.jpg";
    underlyingImage.onload = function () {
      ctx.drawImage(underlyingImage, 0, 0, canvas.width, canvas.height);
      drawOverlay();
    };
    
    function drawOverlay() {
      ctx.fillStyle = "gray";
      ctx.fillRect(0, 0, canvas.width, canvas.height);
    }
    
    let isDrawing = false;
    
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", scratch);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("touchstart", startDrawing);
    canvas.addEventListener("touchmove", scratch);
    canvas.addEventListener("touchend", stopDrawing);
    
    function startDrawing(event) {
      isDrawing = true;
    }
    
    function stopDrawing() {
      isDrawing = false;
      checkScratchPercentage();
    }
    
    function scratch(event) {
      if (!isDrawing) return;
    
      const rect = canvas.getBoundingClientRect();
      const x = (event.clientX || event.touches[0].clientX) - rect.left;
      const y = (event.clientY || event.touches[0].clientY) - rect.top;
    
      ctx.globalCompositeOperation = "destination-out";
      ctx.beginPath();
      ctx.arc(x, y, 15, 0, Math.PI * 2, false);
      ctx.fill();
    }
    
    function checkScratchPercentage() {
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
      const totalPixels = imageData.data.length / 4;
      let scratchedPixels = 0;
    
      for (let i = 3; i < imageData.data.length; i += 4) {
        if (imageData.data[i] === 0) scratchedPixels++;
      }
    
      const scratchedPercentage = (scratchedPixels / totalPixels) * 100;
    
      if (scratchedPercentage > 50) {
        triggerFunction();
      }
    }
    
    function triggerFunction() {
        alert("You got 10% off!");
      
        // Send data to PHP to set session variable
        fetch('set_session.php', {
          method: 'POST',
          body: new URLSearchParams({
            'discount': 0.1  // Send the discount value
          })
        }).then(response => response.text())
          .then(data => {
            console.log(data); // You can see the success message from PHP here
          })
          .catch(error => {
            console.error('Error setting session:', error);
          });
      }
      
    
}

function openModal() {
  const modal = document.getElementById("notificationsModal");
  modal.style.display = "block";  // Show the modal

  drawRectangle();
}

function closeModal() {
  const modal = document.getElementById("notificationsModal");
  modal.style.display = "none";  // Hide the modal
}

window.onclick = function(event) {
  const modal = document.getElementById("notificationsModal");
  if (event.target === modal) {
    modal.style.display = "none";  // Hide the modal if clicked outside
  }
};

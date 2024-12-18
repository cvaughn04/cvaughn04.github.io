const express = require('express');
const fetch = require('node-fetch');
const cors = require('cors');
const app = express();

app.use(cors());
app.use(express.static('public'));


app.get('/search', async (req, res) => {
    const term = req.query.term;
    const latitude = req.query.latitude;
    const longitude = req.query.longitude;
    const apiKey = 'RHweuBK9bfvbWTghTDrURotHxR_0dtDIQvUG8Vd46iunzqCdFCxdu9Ez-zXTdGu7kCQr17dTuxynDLkECY_OshCP06hSuswYGgmm_dh1FRHH_3WBUMMVF3Y8m6XGZXYx';

    try {
        const response = await fetch(`https://api.yelp.com/v3/businesses/search?term=${term}&latitude=${latitude}&longitude=${longitude}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${apiKey}`
            }
        });
        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error('Error:', error);
        res.status(500).send('Internal Server Error');
    }
});

const port = process.env.PORT || 3000;
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});



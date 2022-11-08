import express from 'express';

const app = express();

app.get('/', (req, res) => {
    res.send('Hey, im a API');
});

const port = 5000; 

app.listen(port, () => {
    console.log(`server running on port ${port}`);
});

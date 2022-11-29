import express from 'express';

const app = express();
const port = process.env.NODE_PORT ?? 5000;

app.get('/', (req, res) => {
    res.send('Hey, I\'m an API');
});

app.listen(port, () => {
    console.log(`server running on port ${port}`);
});

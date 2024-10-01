const express = require('express');
const app = express();

app.use(express.json())
app.use(express.urlencoded({extended : true}))




const PORT = 3000;
app.listen(PORT, () => {
console.log(`Server is running on port ${PORT}`);
});


app.post('/users/', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;
    res.send(`name is ${username} and password id ${password}`);
})


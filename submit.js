const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

mongoose.connect('mongodb://localhost:27017/userDB', { useNewUrlParser: true, useUnifiedTopology: true });

const userSchema = new mongoose.Schema({
    password: String
});

const User = mongoose.model('User', userSchema);

app.post('/server_endpoint_url', (req, res) => {
    const password = req.body.password;

    const newUser = new User({
        password: password
    });

    newUser.save((err) => {
        if (err) {
            res.send('Error saving password.');
        } else {
            res.send('Password saved successfully.');
        }
    });
});

app.listen(3000, () => {
    console.log('Server started on port 3000.');
});

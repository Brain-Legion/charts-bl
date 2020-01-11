const express = require('express');
const { Users } = require('./models/users');
const mongoose = require('mongoose');
const bodyParser = require('body-parser')
const fileUpload = require('express-fileupload');
const app = express();


mongoose
    .connect
    (
        'mongodb+srv://root:root@mevn-i1bo2.mongodb.net/test?retryWrites=true&w=majority',
        { useNewUrlParser: true, useUnifiedTopology: true },
        () => console.log('Connected to DB')
    );


app.set('view engine', 'html')
app.use(express.static('public'))
app.use(fileUpload({
    createParentPath: true
}))

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true }))

app.get('/getCategories/:name', (req, res) => {
    Users.find({ name: req.params.name }).then(data => {
        res.send(data)
    })
})

app.get('/teacherevent', (req, res) =>{
    res.sendfile('./public/teacherevent.html')
})


app.get('/loadprint', (req, res) => {
    res.sendfile('./public/loadprint.html')
})


app.get('/login', (req, res) => {
    res.sendfile('./public/login.html')
})


app.post('/sendFile/:name/:type', (req, res) => {
    if (req.files && req.params.name && req.params.type) {
      console.log(req.files)
        Users.find({ name: req.params.name }).then(data => {
            if (data.length) {
                const newCategories = data[0].categories.map(w => w.category === req.params.type ? ({ category: w.category, value: w.value + 1 }) : w)
                Users.updateOne({ name: req.params.name }, { categories: newCategories }).then(() => {
                    req.files.file.mv(`${__dirname}/tmp/${req.files.file.name}`, function (err) {
                        if (err) res.send('Error')
                        res.send({ categories: newCategories })
                    });
                })
            } else {
                res.send('Error')
            }
        })
    } else {
        res.send('Error')
    }
})

app.listen(8080, () => {
    console.log('Server is started')
})
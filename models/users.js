const mongoose = require('mongoose');
const { Schema } = require('mongoose')

const User = new Schema(
  {
    name: String,
    categories: [{
      category: String,
      value: Number
    }]
  }
)

const Users = mongoose.model('Users', User)

module.exports = {
  Users
}


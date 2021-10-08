const { Model } = require('objection');

class Users extends Model {
  static get tableName() {
    return 'user';
  }
}

module.exports = Users;
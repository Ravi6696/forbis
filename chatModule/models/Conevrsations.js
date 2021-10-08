const { Model } = require('objection');

class Conevrsations extends Model {
  static get tableName() {
    return 'conversations';
  }
  $beforeInsert() {
    this.created_at = new Date().toISOString();
    this.updated_at = new Date().toISOString();
    
  }

  $beforeUpdate() {
    this.updated_at = new Date().toISOString();
  }
}

module.exports = Conevrsations;
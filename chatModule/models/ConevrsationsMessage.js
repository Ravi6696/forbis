const { Model } = require('objection');

class ConevrsationsMessage extends Model {
  static get tableName() {
    return 'conversations_message';
  }
  $beforeInsert() {
    this.created_at = new Date().toISOString();
    this.updated_at = new Date().toISOString();

  }

  $beforeUpdate() {
    this.updated_at = new Date().toISOString();
  }  
}

module.exports = ConevrsationsMessage;
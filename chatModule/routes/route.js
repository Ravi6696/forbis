module.exports = (app) =>
{
	const HomeController = require('../controller/HomeController.js');
	app.route('/').get(HomeController.home);
}
/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./vendor/robsontenorio/mary/src/View/Components/**/*.php",
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
	],
	theme: {
		extend: {},
	},
	plugins: [
		require("daisyui")
	],
	darkMode: 'class',
}


module.exports = {
	content: [
		"**/*.html",
		"**/*.php",
		"**/*.js",
		"!wp-admin",
		"!wp-includes",
		"!node_modules",
		"!Prepros Export",
	],
	theme: {
		extend: {
			colors: {
				transparent: "transparent",
				current: "currentColor",
				main: "var(--color-main)",
			},
		},
	},
};
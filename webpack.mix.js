const path = require("path");
const mix = require("laravel-mix");
const CopyPlugin = require("copy-webpack-plugin");

// Resolve Ziggy
mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue"),
});

// Build files
mix.js("resources/js/app.js", "public/js")
    .vue({ version: 3 })
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js"),
            },
        },
        plugins: [
            new CopyPlugin({
                patterns: [
                    { from: "resources/assets", to: "assets" },
                ],
            }),]
    })
    .extract()
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .version();
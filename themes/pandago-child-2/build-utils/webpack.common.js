const webpack = require( 'webpack' );
const path = require( 'path' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

const config = {
  entry: path.resolve(__dirname, "../", "resources/theme.js"),
  output: {
    filename: "theme.js",
    path: path.resolve(__dirname, "../", "assets/"),
  },
  devtool: "source-map",
  devServer: {
    contentBase: path.join(__dirname, "../", "assets/"),
    watchContentBase: true,
    compress: true,
    port: 9000,
    open: true,
    clientLogLevel: 'warning'
  },
  externals: {
    jquery: 'jQuery',
  },
  plugins: [
    new CleanWebpackPlugin(
    	['assets'],
    	{
  			root:     path.resolve(__dirname, "../"),
  			verbose:  true
  		}
  	),
    new CopyWebpackPlugin(
    	[
    		{
    			from: 'resources/img',
    			to: 'img/'
        },
        {
          from: 'resources/vendor',
          to: 'vendor/'
        },
    		{
    			from: 'resources/js/_*.js',
          to: 'js/',
          flatten: true
        }/*,
        {
          from: 'resources/vendor/cookieconsent.min.js',
          to: 'js/'
        }*/
    	],
    	{ debug: 'debug' }
    ),
    new MiniCssExtractPlugin({
      filename: "./css/style.css"
    })
  ],
  module: {
  	rules: [
      {
        test: /\.(png|jpg|svg|gif|mp4)$/,
        exclude: path.resolve(__dirname, "../", "resources/fonts/"),
        use: [
          {
            loader: 'file-loader',
            options: {
            	name: '[name].[ext]',
            	outputPath: './img/'
            }
          }
        ]
      },
      {
        test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
        exclude: path.resolve(__dirname, "../", "resources/img/"),
        use: [
	        {
	          loader: "file-loader",
	          options: {
	            name: "[name].[ext]",
	            outputPath: "./fonts/"
	          }
	        }
        ]
  	  },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          { loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "../"
            } 
          },
          { loader: "css-loader" },
          {
          	loader: "postcss-loader",
          	options: {
          		ident: "postcss",
          		plugins: (loader) => [
          			require('postcss-easing-gradients'),
          			require('autoprefixer')({
			            browsers: [
				            '> 1%',
				            'last 2 versions',
				            'IE 10',
				            'IE 11'
			            ],
			            cascade: false
          			})
          		]
          	}
          },
          { loader: "sass-loader" }
        ]
      }
  	]
  }
};

module.exports = config;
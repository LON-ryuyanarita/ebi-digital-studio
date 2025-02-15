const path = require('path');
const src = __dirname + '/src';
const dist = __dirname + '/dist';

// env
const mode = process.env.NODE_ENV;
const isProduction = mode === 'production';

module.exports = {
  mode,

  context: src,

  entry: {
    bundle: `./assets/js/main.js`,
  },

  output: {
    path: dist,
    filename: '[name].js',
    environment: {
      arrowFunction: false,
    },
  },

  // import 文で .ts ファイルを解決
  resolve: {
    extensions: ['.ts'],
  },

  // babel
  module: {
    rules: [
      {
        // 拡張子 .ts の場合
        test: /\.ts$/,
        // TypeScript をコンパイルする
        use: 'ts-loader',
      },
      {
        // 拡張子 .js の場合
        test: /\.js$/,
        use: [
          {
            // Babel を利用する
            loader: 'babel-loader',
            // Babel のオプションを指定する
            options: {
              presets: [
                // プリセットを指定することで、ES2020 を ES5 に変換
                '@babel/preset-env',
              ],
            },
          },
        ],
      },
      {
        test: /node_modules\/(.+)\.css$/,
        use: [
          {
            loader: 'style-loader',
          },
          {
            loader: 'css-loader',
            options: { url: false },
          },
        ],
        sideEffects: true,
      },
    ],
  },
};

// if (!isProduction) {
//   module.exports.devtool = 'inline-source-map';
// }

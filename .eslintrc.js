module.exports = {
  root: true,
  parserOptions: {
    sourceType: 'module',
    parser: 'babel-eslint',
  },
  env: {
    browser: true,
  },
  extends: [
    'prettier',
    'prettier/standard',
    'plugin:vue/recommended',
    'plugin:jest/recommended',
  ],
  plugins: ['vue', 'prettier'],
  rules: {
    'prettier/prettier': 'error',
    'vue/no-unused-components': 0,
  },
};

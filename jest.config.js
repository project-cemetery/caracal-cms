module.exports = {
  moduleFileExtensions: ['js', 'json', 'vue'],
  transform: {
    '^.+\\.js$': 'babel-jest',
    '.*\\.(vue)$': 'babel-jest',
  },
  moduleNameMapper: {
    '@site/(.*)': '<rootDir>/assets/$1',
  },
};

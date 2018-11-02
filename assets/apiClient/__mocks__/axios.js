export const mockResponse = { data: { result: true } };

export default {
  post() {
    return Promise.resolve(mockResponse.data);
  },
};

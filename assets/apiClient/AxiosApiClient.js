import axios from "axios";

class AxiosApiClient {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  login(userCredentials) {
    return axios
      .post(`${this.baseUrl}/login`, userCredentials, {
        headers: { "Content-Type": "application/json" }
      })
      .then(response => response.data);
  }
}

export default AxiosApiClient;

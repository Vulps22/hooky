class API {

    private static base = 'http://localhost/';
  
    static user = {
      register: (data: any, success: any, error: any) => this.post('user/register', data, success, error),
      login: (data: any, success: any, error: any) => this.post('user/login', data, success, error)
    }
  
    static post(url: string, data: any, success: any, error: any) {
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      };
  
      this.fetch(url, options, success, error);
    }
  
    static get(url: any, success: any, error: any) {
      const options = {
        method: "GET",
      };
  
      this.fetch(url, options, success, error);
    }
  
    static put(url: any, data: any, success: any, error: any) {
      const options = {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      };
  
      this.fetch(url, options, success, error);
    }
  
    static delete(url: any, success: any, error: any) {
      const options = {
        method: "DELETE",
      };
  
      this.fetch(url, options, success, error);
    }
  
    static fetch(url: string, options: RequestInit | undefined, success: (arg0: any) => any, error: (arg0: any) => any) {
      console.log(this.base + url);
      fetch(this.base + url, options)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => success(data))
        .catch((err) => error(err));
    }
  }
  
  export default API;
  
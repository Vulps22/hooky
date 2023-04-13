import { defineStore } from 'pinia'

interface User {
    id: number;
    email: string;
    dob: Date;
    created: Date;
    updated: Date;
    termsAccepted: Date;

}

export const useUserStore = defineStore('user', () => ({
  // Define initial state for user store
  user: null as User | null,
  loggedIn: false,

  // Define mutations to update state
  setUser(user: User | null) {
    this.user = user
  },
  setLoggedIn(loggedIn: boolean) {
    this.loggedIn = loggedIn
  },

  // Define actions to perform async tasks and commit mutations
  async login(credentials: any) {
    const response = await fetch('/api/login', {
      method: 'POST',
      body: JSON.stringify(credentials),
      headers: { 'Content-Type': 'application/json' },
    })

    if (response.ok) {
      const user = await response.json()
      this.setUser(user)
      this.setLoggedIn(true)
    } else {
      throw new Error('Login failed')
    }
  },
  async logout() {
    await fetch('/api/logout')
    this.setUser(null)
    this.setLoggedIn(false)
  },
}))

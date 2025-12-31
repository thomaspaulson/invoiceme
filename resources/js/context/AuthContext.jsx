import { createContext, useContext, useEffect, useState } from 'react';
import api from '../api/axios';

const AuthContext = createContext(null);


export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  // Load user on app start
  useEffect(() => {
    api.get('/user')
      .then(res => setUser(res.data))
      .catch(() => setUser(null))
      .finally(() => setLoading(false));
  }, []);

  const login = async (credentials) => {
    try {
      const res = await api.post('/login', credentials);
      setUser(res.data.user ?? res.data);
      return { success: true, token: res.data.token };
    } catch (error) {
      if (error.response?.status === 401) {
        return {
          success: false,
          message: error.response.data.message,
        };
      }

      if (error.response?.status === 422) {
        return {
          success: false,
          errors: error.response.data.errors,
        };
      }

      return {
        success: false,
        message: 'Something went wrong. Try again.',
      };
    }
  };


  const logout = async () => {
    try {
      await api.post('/logout');
      localStorage.removeItem('token');
      setUser(null);
    } catch (error) {
      //
    }
  };

  return (
    <AuthContext.Provider value={{ user, login, logout, loading }}>
      {children}
    </AuthContext.Provider>
  );
}

// Custom hook
export const useAuth = () => useContext(AuthContext);

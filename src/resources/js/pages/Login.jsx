import axios from '../api/axios';
import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';


export default function Login() {
  const { login } = useAuth();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [errors, setErrors] = useState({});
  const [generalError, setGeneralError] = useState('');
  const navigate = useNavigate();

  async function submit(e) {
    e.preventDefault();
    setErrors({});
    setGeneralError('');

    const result = await login({ email, password });
    if (result.success) {
      localStorage.setItem('token', result.token);
      navigate('/');
    } else {
      if (result.errors) {
        setErrors(result.errors);
      } else {
        setGeneralError(result.message);
      }
    }
  }

  return (
    <>
      <form
        onSubmit={submit}
        className="bg-white p-8 rounded shadow w-full max-w-md"
      >
        <h2 className="text-2xl font-bold mb-6 text-center">
          Login
        </h2>

        {generalError && (
          <div className="bg-red-100 text-red-700 p-2 mb-4">
            {generalError}
          </div>
        )}

        <div className="mb-4">
          <label className="block text-sm mb-1">Email</label>
          <input
            type="email"
            className={`w-full border rounded px-3 py-2 ${errors.email ? 'border-red-500' : ''}`}
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
          {errors.email && (
            <p className="text-red-500 text-sm mb-2">
              {errors.email[0]}
            </p>
          )}
        </div>

        <div className="mb-6">
          <label className="block text-sm mb-1">Password</label>
          <input
            type="password"
            className={`w-full border rounded px-3 py-2 ${errors.password ? 'border-red-500' : ''}`}
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
          {errors.password && (
            <p className="text-red-500 text-sm mb-2">
              {errors.password[0]}
            </p>
          )}

        </div>

        <button
          className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
        >
          Login
        </button>
        <p className="text-sm text-center mt-4">
          Don’t have an account?{" "}
          <Link to="/register" className="text-blue-600">
            Register
          </Link>
        </p>

      </form>
    </>
  );
}

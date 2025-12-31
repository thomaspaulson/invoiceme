import axios from '../api/axios';
import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';


export default function Login() {
  const { login } = useAuth();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  async function submit(e) {
    e.preventDefault();
    const result = await login({ email, password });
    if (result.success) {
      localStorage.setItem('token', result.token);
      navigate('/dashboard');
    } else {
      // console.log(result.errors);
      // if (result.errors) {
      //   setErrors(result.errors);
      // } else {
      //   setGeneralError(result.message);
      // }
    }
  }

  return (
    <>
      <form onSubmit={submit} className="p-10 max-w-md mx-auto">
        <input className="border p-2 w-full mb-4"
          placeholder="Email"
          onChange={e => setEmail(e.target.value)} />
        <input type="password" className="border p-2 w-full mb-4"
          placeholder="Password"
          onChange={e => setPassword(e.target.value)} />
        <button className="bg-blue-600 text-white px-4 py-2 w-full">
          Login
        </button>
      </form>
      <Link to="/register">Register</Link>
    </>
  );
}

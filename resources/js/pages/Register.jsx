import axios from '../api/axios';
import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';

export default function Register() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  async function submit(e) {
    e.preventDefault();

    try {
      const response = await axios.post('/register', { name, email, password });
      localStorage.setItem('token', response.data.token);
      navigate('/dashboard');
    } catch (error) {
      console.log(error);
      console.log(error.response.data);
    }


  }

  return (
    <>
      <form onSubmit={submit} className="p-10 max-w-md mx-auto">
        <input className="border p-2 w-full mb-4"
          placeholder="Name"
          onChange={e => setName(e.target.value)} />
        <input className="border p-2 w-full mb-4"
          placeholder="Email"
          onChange={e => setEmail(e.target.value)} />
        <input type="password" className="border p-2 w-full mb-4"
          placeholder="Password"
          onChange={e => setPassword(e.target.value)} />
        <button className="bg-blue-600 text-white px-4 py-2 w-full">
          Register
        </button>
      </form>
      <Link to="/login">login</Link>
    </>
  );
}

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
      // console.log(result.errors);
      // if (result.errors) {
      //   setErrors(result.errors);
      // } else {
      //   setGeneralError(result.message);
      // }

    }


  }

  return (
    <form
      onSubmit={submit}
      className="bg-white p-8 rounded shadow w-full max-w-md"
    >
      <h2 className="text-2xl font-bold mb-6 text-center">
        Register
      </h2>

      <input className="border p-2 w-full mb-4"
        placeholder="Name"
        onChange={e => setName(e.target.value)} />
      <input className="border p-2 w-full mb-4"
        placeholder="Email"
        onChange={e => setEmail(e.target.value)} />
      <input type="password" className="border p-2 w-full mb-4"
        placeholder="Password"
        onChange={e => setPassword(e.target.value)} />
      <button className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Register
      </button>

      <p className="text-sm text-center mt-4">
        Already have an account?{" "}
        <Link to="/login" className="text-blue-600">
          Login
        </Link>
      </p>
    </form>

  );
}

// import axios from '../api/axios';
// import { useEffect, useState } from 'react';
import { useAuth } from '../contexts/AuthContext';


export default function Dashboard() {
  // const [user, setUser] = useState(null);

  const { user, logout } = useAuth();

  async function handleLogout() {
    await logout();
  }
  return (
    <div className="p-10">
      <h1 className="text-2xl font-bold">
        Welcome {user?.name}
      </h1>

      <button
        onClick={handleLogout}
        className="bg-red-600 text-white px-2 py-2"
      >
        Logout
      </button>
    </div>
  );
}

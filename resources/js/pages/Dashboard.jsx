import { useAuth } from '../contexts/AuthContext';


export default function Dashboard() {
  const { user, logout } = useAuth();

  async function handleLogout() {
    await logout();
    localStorage.removeItem('token');
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

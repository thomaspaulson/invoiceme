import { Outlet, Link } from "react-router-dom";
import { useAuth } from '../contexts/AuthContext';

export default function DashboardLayout() {
  const { user, logout } = useAuth();

  async function handleLogout() {
    await logout();
    localStorage.removeItem('token');
  }

  return (
    <div className="flex min-h-screen bg-gray-100">

      {/* Sidebar */}
      <aside className="w-64 bg-white shadow hidden md:block">
        <div className="p-6 text-xl font-bold border-b">
          Welcome {user?.name}
        </div>
        <nav className="p-4 space-y-2">
          <Link to="/" className="block px-4 py-2 rounded bg-blue-100 text-blue-700">Dashboard</Link>
          <Link to="/invoices" className="block px-4 py-2 rounded hover:bg-gray-100">Invoices</Link>
          <Link to="/clients" className="block px-4 py-2 rounded hover:bg-gray-100">Clients</Link>
          <Link to="/items" className="block px-4 py-2 rounded hover:bg-gray-100">Items</Link>
          <a className="block px-4 py-2 rounded hover:bg-gray-100">Reports</a>
          <a className="block px-4 py-2 rounded hover:bg-gray-100">Settings</a>
        </nav>
      </aside>

      {/* Main */}
      <div className="flex-1 flex flex-col">

        {/* Topbar */}
        <header className="bg-white shadow px-6 py-4 flex justify-between items-center">
          <h1 className="text-xl font-semibold">Bills</h1>
          <span className="text-gray-600">
            <button
              onClick={handleLogout}
              className="px-2 py-2"
            >
              Logout
            </button>
          </span>
        </header>

        {/* Content */}
        <main className="p-6">
          <Outlet />
        </main>
      </div>
    </div>

  );
}

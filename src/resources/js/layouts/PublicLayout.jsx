import { Outlet, Link } from "react-router-dom";

export default function PublicLayout() {
  return (
    <div className="min-h-screen bg-gray-100 flex flex-col">

      {/* Header */}
      <header className="bg-white shadow">
        <div className="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
          <Link to="/" className="text-xl font-bold text-blue-600">
            Bills
          </Link>
          <nav className="space-x-4">
            <Link to="/login" className="text-gray-600 hover:text-blue-600">
              Login
            </Link>
            <Link to="/register" className="text-gray-600 hover:text-blue-600">
              Register
            </Link>
            <Link to="/contact" className="text-gray-600 hover:text-blue-600">
              Contact
            </Link>
          </nav>
        </div>
      </header>

      {/* Page Content */}
      <main className="flex-1 flex items-center justify-center p-6">
        <Outlet />
      </main>

      {/* Footer */}
      <footer className="bg-white border-t text-center py-4 text-sm text-gray-500">
        © {new Date().getFullYear()} Bills. All rights reserved.
      </footer>
    </div>
  );
}

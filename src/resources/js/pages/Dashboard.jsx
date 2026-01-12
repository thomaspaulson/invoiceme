import { useAuth } from '../contexts/AuthContext';


export default function Dashboard() {
  const { user, logout } = useAuth();

  async function handleLogout() {
    await logout();
    localStorage.removeItem('token');
  }
  return (
    <>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <Stat title="Users" value="1,245" />
        <Stat title="Revenue" value="$12,450" />
        <Stat title="Orders" value="320" />
      </div>

      <div className="bg-white rounded shadow">
        <div className="p-4 border-b font-semibold">Recent Users</div>
        <table className="w-full">
          <thead className="bg-gray-50">
            <tr>
              <th className="p-3 text-left">Name</th>
              <th className="p-3 text-left">Email</th>
              <th className="p-3 text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr className="border-t">
              <td className="p-3">John Doe</td>
              <td className="p-3">john@example.com</td>
              <td className="p-3 text-green-600">Active</td>
            </tr>
            <tr className="border-t">
              <td className="p-3">Jane Smith</td>
              <td className="p-3">jane@example.com</td>
              <td className="p-3 text-yellow-600">Pending</td>
            </tr>
          </tbody>
        </table>
      </div>
    </>
  );
}



function Stat({ title, value }) {
  return (
    <div className="bg-white p-6 rounded shadow">
      <p className="text-gray-500 text-sm">{title}</p>
      <p className="text-3xl font-bold">{value}</p>
    </div>
  );
}

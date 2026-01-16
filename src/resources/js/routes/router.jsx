import { createBrowserRouter } from "react-router-dom";
import Login from "../pages/Login";
import Register from "../pages/Register";
import Contact from "../pages/Contact";
import Dashboard from "../pages/Dashboard";
import PublicLayout from "../layouts/PublicLayout";
import DashboardLayout from "../layouts/DashboardLayout";
import ProtectedRoute from "./ProtectedRoute";
import InvoiceRoutes from "../pages/invoice/routes";
import ClientRoutes from "../pages/clients/routes";
import ItemRoutes from "../pages/items/routes";

const router = createBrowserRouter([
  {
    element: <PublicLayout />,
    children: [
      { path: "/login", element: <Login /> },
      { path: "/register", element: <Register /> },
      { path: "/contact", element: <Contact /> },
    ],
  },
  {
    path: "/",
    element: (
      <ProtectedRoute>
        <DashboardLayout />
      </ProtectedRoute>
    ),
    children: [
      { index: true, element: <Dashboard /> },
      { path: "/invoices/*", element: <InvoiceRoutes /> },
      { path: "/clients/*", element: <ClientRoutes /> },
      { path: "/items/*", element: <ItemRoutes /> },
    ],
  },
]);

export default router;

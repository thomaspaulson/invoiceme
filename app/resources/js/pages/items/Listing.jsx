import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from "../../api/axios";
const Listing = () => {
  const [invoices, setInvoices] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchInvoices();
  }, []);

  const fetchInvoices = async () => {
    try {
      const response = await api.get('/invoice');
      setInvoices(response.data);
      const data = await response.json();
      setInvoices(data);
    } catch (error) {
      console.error('Error fetching invoices:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Are you sure you want to delete this invoice?')) {
      try {
        await fetch(`/api/invoices/${id}`, { method: 'DELETE' });
        fetchInvoices();
      } catch (error) {
        console.error('Error deleting invoice:', error);
      }
    }
  };

  if (loading) return <div>Loading...</div>;

  return (
    <div className="container mx-auto p-4">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold">Items</h1>
        <Link to="/invoices/create" className="bg-blue-500 text-white px-4 py-2 rounded">
          Create Invoice
        </Link>
      </div>

      <table className="min-w-full bg-white border">
        <thead>
          <tr className="bg-gray-100">
            <th className="px-4 py-2 border">Invoice #</th>
            <th className="px-4 py-2 border">Client</th>
            <th className="px-4 py-2 border">Date</th>
            <th className="px-4 py-2 border">Amount</th>
            <th className="px-4 py-2 border">Status</th>
            <th className="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          {invoices.map((invoice) => (
            <tr key={invoice.id}>
              <td className="px-4 py-2 border">{invoice.number}</td>
              <td className="px-4 py-2 border">{invoice.client_name}</td>
              <td className="px-4 py-2 border">{invoice.date}</td>
              <td className="px-4 py-2 border">${invoice.total}</td>
              <td className="px-4 py-2 border">{invoice.status}</td>
              <td className="px-4 py-2 border">
                <Link to={`/invoices/${invoice.id}`} className="text-blue-500 mr-2">View</Link>
                <Link to={`/invoices/${invoice.id}/edit`} className="text-green-500 mr-2">Edit</Link>
                <button onClick={() => handleDelete(invoice.id)} className="text-red-500">Delete</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Listing;

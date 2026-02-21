import React, { useState, useEffect } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import api from '../../api/axios';

const InvoiceView = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [invoice, setInvoice] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchInvoice();
  }, [id]);

  const fetchInvoice = async () => {
    try {
      const response = await api.get(`/invoices/${id}`);
      setInvoice(response.data);
    } catch (error) {
      console.error('Error fetching invoice:', error);
      alert('Failed to load invoice.');
    } finally {
      setLoading(false);
    }
  };

  const calculateTotal = () => {
    if (!invoice || !invoice.items) return '0.00';
    return invoice.items.reduce((sum, item) => {
      return sum + (item.quantity * item.unit_price);
    }, 0).toFixed(2);
  };

  const getStatusColor = (status) => {
    const colors = {
      draft: 'bg-gray-200 text-gray-800',
      sent: 'bg-blue-200 text-blue-800',
      paid: 'bg-green-200 text-green-800',
      overdue: 'bg-red-200 text-red-800',
    };
    return colors[status] || 'bg-gray-200 text-gray-800';
  };

  const handleDelete = async () => {
    if (window.confirm('Are you sure you want to delete this invoice?')) {
      try {
        await api.delete(`/invoices/${id}`);
        navigate('/invoices');
      } catch (error) {
        console.error('Error deleting invoice:', error);
        alert('Failed to delete invoice.');
      }
    }
  };

  if (loading) return <div className="container mx-auto p-4">Loading...</div>;

  if (!invoice) return <div className="container mx-auto p-4">Invoice not found.</div>;

  return (
    <div className="container mx-auto p-4">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold">Invoice Details</h1>
        <div className="space-x-2">
          <Link
            to={`/invoices/edit/${id}`}
            className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block"
          >
            Edit
          </Link>
          <button
            onClick={handleDelete}
            className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
          >
            Delete
          </button>
          <button
            onClick={() => navigate('/invoices')}
            className="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
          >
            Back to Invoices
          </button>
        </div>
      </div>

      <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div className="grid grid-cols-2 gap-6 mb-6">
          <div>
            <h2 className="text-xl font-bold mb-4">Invoice Information</h2>
            <div className="space-y-2">
              <div>
                <span className="font-semibold">Invoice Number:</span> {invoice.invoice_number}
              </div>
              <div>
                <span className="font-semibold">Status:</span>{' '}
                <span className={`px-2 py-1 rounded ${getStatusColor(invoice.status)}`}>
                  {invoice.status}
                </span>
              </div>
              <div>
                <span className="font-semibold">Invoice Date:</span> {invoice.invoice_date}
              </div>
              <div>
                <span className="font-semibold">Due Date:</span> {invoice.due_date}
              </div>
            </div>
          </div>

          <div>
            <h2 className="text-xl font-bold mb-4">Client Information</h2>
            <div className="space-y-2">
              <div>
                <span className="font-semibold">Name:</span> {invoice.client_name}
              </div>
              <div>
                <span className="font-semibold">Email:</span> {invoice.client_email}
              </div>
            </div>
          </div>
        </div>

        <div className="mb-6">
          <h2 className="text-xl font-bold mb-4">Items</h2>
          <table className="min-w-full bg-white border">
            <thead>
              <tr className="bg-gray-100">
                <th className="px-4 py-2 border text-left">Description</th>
                <th className="px-4 py-2 border text-right">Quantity</th>
                <th className="px-4 py-2 border text-right">Unit Price</th>
                <th className="px-4 py-2 border text-right">Total</th>
              </tr>
            </thead>
            <tbody>
              {invoice.items && invoice.items.map((item, index) => (
                <tr key={index} className="hover:bg-gray-50">
                  <td className="px-4 py-2 border">{item.description}</td>
                  <td className="px-4 py-2 border text-right">{item.quantity}</td>
                  <td className="px-4 py-2 border text-right">${item.unit_price.toFixed(2)}</td>
                  <td className="px-4 py-2 border text-right">
                    ${(item.quantity * item.unit_price).toFixed(2)}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        <div className="flex justify-end">
          <div className="text-right">
            <div className="text-2xl font-bold">
              Total: ${calculateTotal()}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default InvoiceView;

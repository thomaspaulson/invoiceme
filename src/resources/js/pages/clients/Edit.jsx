import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import api from '../../api/axios';

const Edit = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);
  const [fetching, setFetching] = useState(true);
  const [formData, setFormData] = useState({
    invoice_number: '',
    client_name: '',
    client_email: '',
    invoice_date: '',
    due_date: '',
    status: 'draft',
    items: [{ description: '', quantity: 1, unit_price: 0 }],
  });

  useEffect(() => {
    fetchInvoice();
  }, [id]);

  const fetchInvoice = async () => {
    try {
      const response = await api.get(`/invoices/${id}`);
      setFormData(response.data);
    } catch (error) {
      console.error('Error fetching invoice:', error);
      alert('Failed to load invoice.');
    } finally {
      setFetching(false);
    }
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleItemChange = (index, field, value) => {
    const updatedItems = [...formData.items];
    updatedItems[index][field] = value;
    setFormData((prev) => ({
      ...prev,
      items: updatedItems,
    }));
  };

  const addItem = () => {
    setFormData((prev) => ({
      ...prev,
      items: [...prev.items, { description: '', quantity: 1, unit_price: 0 }],
    }));
  };

  const removeItem = (index) => {
    setFormData((prev) => ({
      ...prev,
      items: prev.items.filter((_, i) => i !== index),
    }));
  };

  const calculateTotal = () => {
    return formData.items.reduce((sum, item) => {
      return sum + (item.quantity * item.unit_price);
    }, 0).toFixed(2);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      await api.put(`/invoices/${id}`, formData);
      navigate('/invoices');
    } catch (error) {
      console.error('Error updating invoice:', error);
      alert('Failed to update invoice. Please try again.');
    } finally {
      setLoading(false);
    }
  };

  if (fetching) return <div className="container mx-auto p-4">Loading...</div>;

  return (
    <div className="container mx-auto p-4">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold">Edit Invoice</h1>
        <button
          onClick={() => navigate('/invoices')}
          className="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
        >
          Back to Invoices
        </button>
      </div>

      <form onSubmit={handleSubmit} className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div className="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Invoice Number
            </label>
            <input
              type="text"
              name="invoice_number"
              value={formData.invoice_number}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
              required
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Status
            </label>
            <select
              name="status"
              value={formData.status}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
            >
              <option value="draft">Draft</option>
              <option value="sent">Sent</option>
              <option value="paid">Paid</option>
              <option value="overdue">Overdue</option>
            </select>
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Client Name
            </label>
            <input
              type="text"
              name="client_name"
              value={formData.client_name}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
              required
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Client Email
            </label>
            <input
              type="email"
              name="client_email"
              value={formData.client_email}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
              required
            />
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Invoice Date
            </label>
            <input
              type="date"
              name="invoice_date"
              value={formData.invoice_date}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
              required
            />
          </div>

          <div>
            <label className="block text-gray-700 text-sm font-bold mb-2">
              Due Date
            </label>
            <input
              type="date"
              name="due_date"
              value={formData.due_date}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
              required
            />
          </div>
        </div>

        <div className="mb-4">
          <div className="flex justify-between items-center mb-2">
            <h2 className="text-xl font-bold">Items</h2>
            <button
              type="button"
              onClick={addItem}
              className="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
            >
              Add Item
            </button>
          </div>

          {formData.items.map((item, index) => (
            <div key={index} className="grid grid-cols-12 gap-2 mb-2">
              <div className="col-span-5">
                <input
                  type="text"
                  placeholder="Description"
                  value={item.description}
                  onChange={(e) => handleItemChange(index, 'description', e.target.value)}
                  className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                  required
                />
              </div>
              <div className="col-span-2">
                <input
                  type="number"
                  placeholder="Quantity"
                  value={item.quantity}
                  onChange={(e) => handleItemChange(index, 'quantity', parseFloat(e.target.value))}
                  className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                  min="1"
                  required
                />
              </div>
              <div className="col-span-3">
                <input
                  type="number"
                  placeholder="Unit Price"
                  value={item.unit_price}
                  onChange={(e) => handleItemChange(index, 'unit_price', parseFloat(e.target.value))}
                  className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                  step="0.01"
                  min="0"
                  required
                />
              </div>
              <div className="col-span-2">
                <button
                  type="button"
                  onClick={() => removeItem(index)}
                  className="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 w-full"
                  disabled={formData.items.length === 1}
                >
                  Remove
                </button>
              </div>
            </div>
          ))}

          <div className="text-right mt-4">
            <strong className="text-xl">Total: ${calculateTotal()}</strong>
          </div>
        </div>

        <div className="flex justify-end space-x-2">
          <button
            type="button"
            onClick={() => navigate('/invoices')}
            className="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
          >
            Cancel
          </button>
          <button
            type="submit"
            disabled={loading}
            className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 disabled:bg-blue-300"
          >
            {loading ? 'Updating...' : 'Update Invoice'}
          </button>
        </div>
      </form>
    </div>
  );
};

export default Edit;

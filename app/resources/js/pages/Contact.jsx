import { useState } from "react";

export default function Contact() {
  const [form, setForm] = useState({
    name: "",
    email: "",
    message: "",
  });

  const submit = (e) => {
    e.preventDefault();
    console.log(form);
    alert("Message sent (mock)");
  };

  return (
    <form className="bg-white p-8 rounded shadow w-full max-w-lg">
      <h2 className="text-2xl font-bold mb-6 text-center">
        Contact Us
      </h2>

      <div className="mb-4">
        <label className="block text-sm mb-1">Name</label>
        <input
          className="w-full border rounded px-3 py-2"
          value={form.name}
          onChange={(e) =>
            setForm({ ...form, name: e.target.value })
          }
        />
      </div>

      <div className="mb-4">
        <label className="block text-sm mb-1">Email</label>
        <input
          type="email"
          className="w-full border rounded px-3 py-2"
          value={form.email}
          onChange={(e) =>
            setForm({ ...form, email: e.target.value })
          }
        />
      </div>

      <div className="mb-6">
        <label className="block text-sm mb-1">Message</label>
        <textarea
          rows="4"
          className="w-full border rounded px-3 py-2"
          value={form.message}
          onChange={(e) =>
            setForm({ ...form, message: e.target.value })
          }
        />
      </div>

      <button className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Send Message
      </button>
    </form>
  );
}

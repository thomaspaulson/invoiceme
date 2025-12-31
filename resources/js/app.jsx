import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom/client';

function App() {
    return <h1 className="text-3xl font-bold underline text-red-500">Hello from React + Laravel 12!</h1>;
}

ReactDOM.createRoot(document.getElementById('app')).render(<App />);

import React from 'react';
import { Route, Routes } from 'react-router-dom';
import Listing from './Listing';
import Create from './Create';
import Edit from './Edit';
import View from './View';

const InvoiceRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<Listing />} />
      <Route path="/create" element={<Create />} />
      <Route path="/edit/:id" element={<Edit />} />
      <Route path="/view/:id" element={<View />} />
    </Routes>
  );
};

export default InvoiceRoutes;

import React from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom';
import LoginForm from './Login/LoginForm';
import ProtectedPage from './ProtectedPage/ProtectedPage';
import AuthService from './Auth/AuthService';
import Home from './Home/Home';
import CreateUser from './User/CreateUser';

const PrivateRoute = ({ element }) => {
  return AuthService.isAuthenticated() ? element : <Navigate to="/login" />;
};

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/createUser" element={<CreateUser />} />
        <Route path="/login" element={<LoginForm />} />
        <Route
          path="/protected"
          element={<PrivateRoute element={<ProtectedPage />} />}
        />
      </Routes>
    </Router>
  );
};

export default App;

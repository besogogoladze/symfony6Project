import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const ProtectedPage = () => {
  const [data, setData] = useState(null);
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchProtectedData = async () => {
      const token = localStorage.getItem('token');
      if (!token) {
        navigate('/login'); // Redirect to login if no token
        return;
      }

      try {
        const response = await fetch('http://localhost:8000/protected-route', {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });

        if (response.ok) {
          const data = await response.json();
          setData(data);
        } else {
          setError('Failed to load protected data');
        }
      } catch (error) {
        setError('Error fetching data');
      }
    };

    fetchProtectedData();
  }, [navigate]);

  return (
    <div>
      <h2>Protected Page</h2>
      {data ? (
        <div>
          <h3>Protected Data:</h3>
          <pre>{JSON.stringify(data, null, 2)}</pre>
        </div>
      ) : (
        <p>Loading data...</p>
      )}
      {error && <p style={{ color: 'red' }}>{error}</p>}
    </div>
  );
};

export default ProtectedPage;

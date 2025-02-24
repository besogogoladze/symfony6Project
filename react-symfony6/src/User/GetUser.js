import React, { useState, useEffect } from 'react';

const GetUser = ({ userId }) => {
  const [user, setUser] = useState(null);

  useEffect(() => {
    const fetchUser = async () => {
      const response = await fetch(`http://localhost:8000/user/${userId}`);
      const data = await response.json();
      setUser(data);
    };

    fetchUser();
  }, [userId]);

  return user ? (
    <div>
      <h3>User Details</h3>
      <p>Name: {user.name}</p>
      <p>Surname: {user.surname}</p>
      <p>Age: {user.age}</p>
    </div>
  ) : (
    <p>Loading...</p>
  );
};

export default GetUser;

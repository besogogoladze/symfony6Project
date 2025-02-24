import React, { useState } from 'react';

const CreateUser = () => {
  const [formData, setFormData] = useState({
    id: '',
    name: '',
    surname: '',
    age: ''
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const response = await fetch('http://localhost:8000/user/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    });

    const data = await response.json();
    console.log(data);
  };

  return (
    <form onSubmit={handleSubmit}>
      <input type="text" name="id" placeholder="ID" value={formData.id} onChange={handleChange} />
      <input type="text" name="name" placeholder="Name" value={formData.name} onChange={handleChange} />
      <input type="text" name="surname" placeholder="Surname" value={formData.surname} onChange={handleChange} />
      <input type="number" name="age" placeholder="Age" value={formData.age} onChange={handleChange} />
      <button type="submit">Create User</button>
    </form>
  );
};

export default CreateUser;

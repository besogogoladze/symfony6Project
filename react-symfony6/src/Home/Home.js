import React from 'react'

function Home() {
  return (
    <div>
      <button onClick={() => window.location.href = '/login'}>Login</button>
      <button onClick={() => window.location.href = '/createUser'}>Create User</button>
    </div>
  )
}

export default Home

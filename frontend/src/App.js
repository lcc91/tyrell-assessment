import logo from './logo.svg';
import './App.css';
import React, { useState, useEffect } from 'react';

function App() {
  //init state
  const [noOfPeople, setNoOfPeople] = useState('');
  const [data, setData] = useState([]);
  const [error, setError] = useState('');

  //calling api
  const fetchData = async () => {
    try {
      const response = await fetch(`http://localhost:8000/distribute-cards.php?noOfPeople=${noOfPeople}`);
      const result = await response.json();
      if (result.status == 'success') {
        setData(result.data);
      } else {
        setError(result.message);
      }
    } catch (error) {
      setError('An error occurred while fetching the data.');
    }
  };

  //set no of people while onChange
  const handleInputChange = (event) => {
    setNoOfPeople(event.target.value);
  };

  //fetch data onSubmit
  const handleSubmit = (event) => {
    event.preventDefault();
    fetchData();
  };

  return (
    <div className="App">
      <h1>Card Distribution</h1>
      <form onSubmit={handleSubmit}>
        <label>
          No of People:
          <input type="text" value={noOfPeople} onChange={handleInputChange} />
        </label>
        <button type="submit">Submit</button>
      </form>
      {error && <p style={{ color: 'red' }}>{error}</p>}
      <table border="1">
        <thead>
          <tr>
            <th>Person</th>
            <th>Cards</th>
          </tr>
        </thead>
        <tbody>
          {data.map((cards, index) => (
            <tr key={index}>
              <td>Person {index + 1}</td>
              <td>{cards.join(',')}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default App;

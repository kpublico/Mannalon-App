import React from 'react';
import ReactDOM from 'react-dom/client';

// Import CSS
import '../css/app.css';

// Example component - can be removed if not needed
const App = () => {
    return (
        <div className="text-center py-10">
            <h1 className="text-3xl font-bold">Welcome to MannalonApp</h1>
        </div>
    );
};

// Only mount if a root element exists
const rootElement = document.getElementById('app');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(<App />);
}

export default App;

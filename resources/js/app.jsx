import React from 'react';
import ReactDOM from 'react-dom/client';
import PostsIndex from './components/PostsIndex';

const container = document.getElementById('react-root');

if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<PostsIndex />);
} else {
    console.error('React root container not found!');
}

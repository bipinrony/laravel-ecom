import "./bootstrap";
import "../css/app.css";

import React from 'react'
import { createRoot } from 'react-dom/client'
import Header from "./src/Header";
import Footer from "./src/Footer";

export default function App() {
  return (
    <div>
        <Header/>
        App
        <Footer/>
    </div>
  )
}

if (document.getElementById("react-app-root")) {
    createRoot(document.getElementById('react-app-root')).render(<App />)
}


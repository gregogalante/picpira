import React, { createContext, useState } from 'react'
import { createRoot } from 'react-dom/client'
import { createBrowserRouter, RouterProvider } from "react-router-dom"

export const VERSION = document.querySelector('meta[name="$VERSION"]').content
export const DIRECTORY_PATH = document.querySelector('meta[name="$DIRECTORY_PATH"]').content

// Routes
////////////////////////////////////////

import HomePage from './pages/HomePage'
import SignInPage from './pages/SigninPage'
import SignupPage from './pages/SignupPage'
import RecoverPasswordPage from './pages/RecoverPasswordPage'
import RecoverPasswordUpdatePage from './pages/RecoverPasswordUpdatePage'

const AppRouter = createBrowserRouter([
  {
    path: DIRECTORY_PATH,
    element: <HomePage />,
  },
  {
    path: `${DIRECTORY_PATH}signin`,
    element: <SignInPage />,
  },
  {
    path: `${DIRECTORY_PATH}signup`,
    element: <SignupPage />,
  },
  {
    path: `${DIRECTORY_PATH}recover-password`,
    element: <RecoverPasswordPage />,
  },
  {
    path: `${DIRECTORY_PATH}recover-password/update`,
    element: <RecoverPasswordUpdatePage />,
  },
])

// Context
////////////////////////////////////////

export const AppContext = createContext()
export const AppProvider = ({ children }) => {
  const [state, setState] = useState({})

  return <AppContext.Provider value={{
    state,
    setState
  }}>{children}</AppContext.Provider>
}

// App
////////////////////////////////////////

function App() {
  console.log('VERSION:', VERSION)
  console.log('DIRECTORY_PATH:', DIRECTORY_PATH)

  return (
    <AppProvider>
      <RouterProvider router={AppRouter} />
    </AppProvider>
  )
}

const root = createRoot(document.getElementById('root'))
root.render(<App />)

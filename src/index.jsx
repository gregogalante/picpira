import React, { createContext, useState } from 'react'
import { createRoot } from 'react-dom/client'
import { createBrowserRouter, RouterProvider } from "react-router-dom"

export const TITLE = document.querySelector('meta[name="$TITLE"]').content
export const VERSION = document.querySelector('meta[name="$VERSION"]').content
export const DIRECTORY_PATH = document.querySelector('meta[name="$DIRECTORY_PATH"]').content

// Routes
////////////////////////////////////////

import ErrorPage from './pages/ErrorPage'
import HomePage from './pages/HomePage'
import SignInPage from './pages/SigninPage'
import SignupPage from './pages/SignupPage'
import RecoverPasswordPage from './pages/RecoverPasswordPage'
import RecoverPasswordUpdatePage from './pages/RecoverPasswordUpdatePage'

const AppRouter = createBrowserRouter([
  {
    path: '/',
    element: <HomePage />,
    errorElement: <ErrorPage />,
  },
  {
    path: `/signin`,
    element: <SignInPage />,
  },
  {
    path: `/signup`,
    element: <SignupPage />,
  },
  {
    path: `/recover-password`,
    element: <RecoverPasswordPage />,
  },
  {
    path: `/recover-password/update`,
    element: <RecoverPasswordUpdatePage />,
  },
], {
  basename: DIRECTORY_PATH
})

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
  console.log('TITLE:', TITLE)
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

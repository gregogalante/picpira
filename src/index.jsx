import React, { createContext, useState, useEffect, useRef } from 'react'
import { createRoot } from 'react-dom/client'
import { createBrowserRouter, RouterProvider } from "react-router-dom"
import Cookies from 'js-cookie'

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
  const [state, setState] = useState({
    authToken: Cookies.get('authToken')
  })
  const updateStateKeyResolves = useRef({})

  useEffect(() => {
    const currentCookie = Cookies.get('authToken')
    if (currentCookie !== state.authToken && state.authToken) {
      Cookies.set('authToken', state.authToken, { sameSite: 'strict', secure: true, expires: 365 })
    } else if (currentCookie !== state.authToken && !state.authToken) {
      Cookies.remove('authToken')
    }
  }, [state.authToken])

  useEffect(() => {
    for (const key in updateStateKeyResolves.current) {
      console.log('AppContext.updateStateKey', 'RESOLVING:', key, state[key])
      updateStateKeyResolves.current[key](state[key])
    }
    updateStateKeyResolves.current = {}
  }, [state])

  const updateStateKey = async (key, value) => {
    return new Promise((resolve) => {
      updateStateKeyResolves.current[key] = resolve
      setState((prevState) => ({
        ...prevState,
        [key]: value
      }))
    })
  }

  return <AppContext.Provider value={{
    state,
    setState,
    updateStateKey
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

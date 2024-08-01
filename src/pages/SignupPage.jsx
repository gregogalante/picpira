import React, { useState, useContext } from 'react'
import { useNavigate } from 'react-router-dom'
import { AppContext, DIRECTORY_PATH } from '..'
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'
import InputComponent from '../components/InputComponent'
import ButtonComponent from '../components/ButtonComponent'
import AlertComponent from '../components/AlertComponent'

export default function SignupPage() {
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState(null)
  const appContext = useContext(AppContext)

  const onSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)

    try {
      const formData = new FormData(e.target)
      formData.append('action', 'authSignup')

      const emailValue = formData.get('email')
      formData.append('username', emailValue)

      const response = await fetch(`${DIRECTORY_PATH}api.php`, {
        method: 'POST',
        body: formData
      })
      const responseJson = await response.json()
      if (!responseJson.success) throw new Error(responseJson.error)

      await appContext.updateStateKey('authToken', responseJson.data.authToken)
      navigate('/')
    } catch (error) {
      console.error(error)
      setError(error.message)
    } finally {
      setLoading(false)
    }
  }

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-6'>Sign-up</TitleComponent>

      {error && (
        <AlertComponent type='error' className='mb-4'>{error}</AlertComponent>
      )}

      <form
        className='flex flex-col space-y-4'
        onSubmit={onSubmit}
      >
        <InputComponent
          label="First name"
          id="first_name"
          name="first_name"
          onFocus={() => setError(null)}
          required
        />

        <InputComponent
          label="Last name"
          id="last_name"
          name="last_name"
          onFocus={() => setError(null)}
          required
        />

        <InputComponent
          label="Phone"
          id="phone"
          name="phone"
          onFocus={() => setError(null)}
          required
        />

        <InputComponent
          label="Email"
          id="email"
          name="email"
          type="email"
          autoComplete="username"
          onFocus={() => setError(null)}
          required
        />

        <InputComponent
          label="Password"
          id="password"
          name="password"
          type="password"
          autoComplete="current-password"
          onFocus={() => setError(null)}
          required
        />

        <ButtonComponent
          className='mt-6'
          type="submit"
          disabled={loading}
        >Confirm</ButtonComponent>
      </form>

      <a
        href="/signin"
        className='mt-4 text-blue-700 hover:underline'
        onClick={(e) => {
          e.preventDefault()
          navigate('/signin')
        }}
      >Sign-in</a>
    </ContainerComponent>
  )
}
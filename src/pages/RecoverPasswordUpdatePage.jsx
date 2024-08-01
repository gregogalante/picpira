import React, { useState, useContext } from 'react'
import { useNavigate } from 'react-router-dom'
import { AppContext, DIRECTORY_PATH } from '..'
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'
import InputComponent from '../components/InputComponent'
import ButtonComponent from '../components/ButtonComponent'
import AlertComponent from '../components/AlertComponent'

export default function RecoverPasswordUpdatePage() {
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState(null)

  const onSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)

    try {
      const formData = new FormData(e.target)
      formData.append('action', 'authRecoverPasswordUpdate')

      const username = new URLSearchParams(window.location.search).get('username')
      if (!username) throw new Error('Username not found')
      formData.append('username', username)

      const response = await fetch(`${DIRECTORY_PATH}api.php`, {
        method: 'POST',
        body: formData
      })
      const responseJson = await response.json()
      if (!responseJson.success) throw new Error(responseJson.error)

      navigate('/signin')
    } catch (error) {
      console.error(error)
      setError(error.message)
    } finally {
      setLoading(false)
    }
  }

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-6'>Complete recover password</TitleComponent>

      {error && (
        <AlertComponent type='error' className='mb-4'>{error}</AlertComponent>
      )}

      <form
        className='flex flex-col space-y-4'
        onSubmit={onSubmit}
      >
        <InputComponent
          label="Code"
          id="token"
          name="token"
          onFocus={() => setError(null)}
          required
        />

        <InputComponent
          label="New password"
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
        >Continue</ButtonComponent>
      </form>
    </ContainerComponent>
  )
}
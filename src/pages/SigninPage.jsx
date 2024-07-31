import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { DIRECTORY_PATH } from '..'
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'
import InputComponent from '../components/InputComponent'
import ButtonComponent from '../components/ButtonComponent'

export default function SigninPage() {
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)

  const onSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)

    try {
      const formData = new FormData(e.target)
      formData.append('action', 'authSignin')
      const response = await fetch(`${DIRECTORY_PATH}/api.php`, {
        method: 'POST',
        body: formData
      })
      const responseJson = await response.json()
      if (!responseJson.success) throw new Error(responseJson.error)

      console.log(responseJson)
    } catch (error) {
      console.error(error)
    } finally {
      setLoading(false)
    }
  }

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-6'>Sign-in</TitleComponent>

      <form
        className='flex flex-col space-y-4'
        onSubmit={onSubmit}
      >
        <InputComponent
          label="Email"
          id="username"
          name="username"
          type="email"
          autoComplete="username"
        />

        <InputComponent
          label="Password"
          id="password"
          type="password"
          autoComplete="current-password"
        />

        <ButtonComponent
          className='mt-6'
          type="submit"
          disabled={loading}
        >Confirm</ButtonComponent>
      </form>
    </ContainerComponent>
  )
}
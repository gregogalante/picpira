import React from 'react'
import { useNavigate } from 'react-router-dom'
import { TITLE } from '..'
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'
import ButtonComponent from '../components/ButtonComponent'

export default function HomePage() {
  const navigate = useNavigate()

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-6'>{TITLE}</TitleComponent>

      <div className='flex flex-col space-y-2'>
        <ButtonComponent onClick={() => navigate('/signin')}>Sign in</ButtonComponent>
        <ButtonComponent onClick={() => navigate('/signup')}>Sign up</ButtonComponent>
        <ButtonComponent onClick={() => navigate('/recover-password')}>Recover password</ButtonComponent>
      </div>
    </ContainerComponent>
  )
}
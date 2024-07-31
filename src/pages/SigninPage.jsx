import React from 'react'
import { useNavigate } from 'react-router-dom'
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'
import ButtonComponent from '../components/ButtonComponent'

export default function SigninPage() {
  const navigate = useNavigate()

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-6'>Sign-in</TitleComponent>
    </ContainerComponent>
  )
}
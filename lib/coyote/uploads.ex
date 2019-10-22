defmodule Coyote.Uploads do
  @moduledoc """
  The Uploads context.
  """

  import Ecto.Query, warn: false
  alias Coyote.Repo

  alias Coyote.Uploads.File

  @doc """
  Returns the list of files.

  ## Examples

      iex> list_files()
      [%File{}, ...]

  """
  def list_files do
    Repo.all(File)
  end

  @doc """
  Gets a single file.

  Raises `Ecto.NoResultsError` if the File does not exist.

  ## Examples

      iex> get_file!(123)
      %File{}

      iex> get_file!(456)
      ** (Ecto.NoResultsError)

  """
  def get_file!(id), do: Repo.get!(File, id)

  @doc """
  Creates a file.

  ## Examples

      iex> create_file(%{field: value})
      {:ok, %File{}}

      iex> create_file(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_file(attrs \\ %{}) do
    %File{}
    |> File.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a file.

  ## Examples

      iex> update_file(file, %{field: new_value})
      {:ok, %File{}}

      iex> update_file(file, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_file(%File{} = file, attrs) do
    file
    |> File.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a File.

  ## Examples

      iex> delete_file(file)
      {:ok, %File{}}

      iex> delete_file(file)
      {:error, %Ecto.Changeset{}}

  """
  def delete_file(%File{} = file) do
    Repo.delete(file)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking file changes.

  ## Examples

      iex> change_file(file)
      %Ecto.Changeset{source: %File{}}

  """
  def change_file(%File{} = file) do
    File.changeset(file, %{})
  end

  alias Coyote.Uploads.Minute

  @doc """
  Returns the list of minutes.

  ## Examples

      iex> list_minutes()
      [%Minute{}, ...]

  """
  def list_minutes do
    Repo.all(Minute)
  end

  @doc """
  Gets a single minute.

  Raises `Ecto.NoResultsError` if the Minute does not exist.

  ## Examples

      iex> get_minute!(123)
      %Minute{}

      iex> get_minute!(456)
      ** (Ecto.NoResultsError)

  """
  def get_minute!(id), do: Repo.get!(Minute, id)

  @doc """
  Creates a minute.

  ## Examples

      iex> create_minute(%{field: value})
      {:ok, %Minute{}}

      iex> create_minute(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_minute(attrs \\ %{}) do
    %Minute{}
    |> Minute.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a minute.

  ## Examples

      iex> update_minute(minute, %{field: new_value})
      {:ok, %Minute{}}

      iex> update_minute(minute, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_minute(%Minute{} = minute, attrs) do
    minute
    |> Minute.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a Minute.

  ## Examples

      iex> delete_minute(minute)
      {:ok, %Minute{}}

      iex> delete_minute(minute)
      {:error, %Ecto.Changeset{}}

  """
  def delete_minute(%Minute{} = minute) do
    Repo.delete(minute)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking minute changes.

  ## Examples

      iex> change_minute(minute)
      %Ecto.Changeset{source: %Minute{}}

  """
  def change_minute(%Minute{} = minute) do
    Minute.changeset(minute, %{})
  end

  alias Coyote.Uploads.Newsletter

  @doc """
  Returns the list of newsletters.

  ## Examples

      iex> list_newsletters()
      [%Newsletter{}, ...]

  """
  def list_newsletters do
    Repo.all(Newsletter)
  end

  @doc """
  Gets a single newsletter.

  Raises `Ecto.NoResultsError` if the Newsletter does not exist.

  ## Examples

      iex> get_newsletter!(123)
      %Newsletter{}

      iex> get_newsletter!(456)
      ** (Ecto.NoResultsError)

  """
  def get_newsletter!(id), do: Repo.get!(Newsletter, id)

  @doc """
  Creates a newsletter.

  ## Examples

      iex> create_newsletter(%{field: value})
      {:ok, %Newsletter{}}

      iex> create_newsletter(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_newsletter(attrs \\ %{}) do
    %Newsletter{}
    |> Newsletter.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a newsletter.

  ## Examples

      iex> update_newsletter(newsletter, %{field: new_value})
      {:ok, %Newsletter{}}

      iex> update_newsletter(newsletter, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_newsletter(%Newsletter{} = newsletter, attrs) do
    newsletter
    |> Newsletter.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a Newsletter.

  ## Examples

      iex> delete_newsletter(newsletter)
      {:ok, %Newsletter{}}

      iex> delete_newsletter(newsletter)
      {:error, %Ecto.Changeset{}}

  """
  def delete_newsletter(%Newsletter{} = newsletter) do
    Repo.delete(newsletter)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking newsletter changes.

  ## Examples

      iex> change_newsletter(newsletter)
      %Ecto.Changeset{source: %Newsletter{}}

  """
  def change_newsletter(%Newsletter{} = newsletter) do
    Newsletter.changeset(newsletter, %{})
  end
end
